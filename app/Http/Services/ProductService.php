<?php

namespace App\Http\Services;

use Auth;
use Session;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\Production;
use App\Models\UnitConversion;
use App\Models\BranchTable;

class ProductService
{  
    public function updateProductionBatch($params = [])
    {   

        $ctr = 1;
        $batchStatus = '';
        $newSold = $params->newSold;

        $productions = (new Production)->getAvailable($params->productId);

        foreach ($productions as $production) {

            if ($newSold > 0) {

                $batchStatus = $newSold >= $production->available ? 0 : 1;

                $production->update([
                    'sold' => ($newSold >= $production->available) ? $production->sold + $production->available : $production->sold + $newSold,
                    'batch_status' => $batchStatus
                ]);

                $newSold = ($newSold <= $production->available) ? 0 : $newSold - $production->available;

            }else {

                if ($batchStatus == 0 && (count($productions) > $ctr)) {
                    $production->update([
                        'batch_status' => 1
                    ]);
                }

                $newBatchActive = $production->join('pricing_batches', 'pricing_batches.id', 'productions.pricing_batch_id')->first();

                if ($newBatchActive->batch_srp <> $params->srp) {
                    Session::push('new_price_list', (object) [
                        'product' => $params->product,
                        'old_srp' => $params->srp,
                        'new_srp' => $newBatchActive->batch_srp,
                        'increased' => $newBatchActive->batch_srp > $params->srp ? true : false
                    ]);
                }

                break;
            }

            $ctr++;
        }
    }


    public function updateStocks($params = [])
    {   
        
        $ctr = 0;

        $purchaseDetails = PurchaseDetail::join('material_suppliers', 'material_suppliers.id', 'purchase_details.material_supplier_id')
            ->select('purchase_details.id as purchase_detail_id', 'purchase_details.*')
            ->where('material_suppliers.product_id', $params->productId)
            ->where('available', '>', 0)
            ->get();

        $newConsumed = $params->newConsumed;

        foreach ($purchaseDetails as $purchaseDetail) {
            if ($newConsumed > 0) {
                PurchaseDetail::find($purchaseDetail->purchase_detail_id)->update([
                    'batch_status' => $purchaseDetail->available <= $newConsumed ? 'Inactive' : 'Active',
                    'consumed' => $purchaseDetail->available < $newConsumed ? $purchaseDetail->receive_qty : $purchaseDetail->consumed + $newConsumed,
                    'available' => $purchaseDetail->available < $newConsumed ? 0 : $purchaseDetail->available - $newConsumed
                ]); 

                if ($ctr > 0) {
                    $this->updateConversions((object) [
                        'productId' => $params->productId,
                        'unitPrice' => $purchaseDetail->unit_price
                    ]);
                }
                
                $newConsumed = $purchaseDetail->available < $newConsumed ? ($newConsumed - $purchaseDetail->available) : 0;
                $ctr++;
            }
        }

        $activeBatch = (new PurchaseDetail)->findActiveBatchProduct($purchaseDetail->product_id);

        if ((count($purchaseDetails) > $ctr) && !$activeBatch) {
            
            $nextActiveBatch = PurchaseDetail::join('material_suppliers', 'material_suppliers.id', 'purchase_details.material_supplier_id')
                ->where('material_suppliers.product_id', $params->productId)
                ->where('available', '>', 0)
                ->where('purchase_details.branch_code', Auth::user()->branch_code)
                ->select('purchase_details.*')
                ->first();

            $nextActiveBatch->update([
                'batch_status' => 'Active'
            ]);

            $defaultRetail = $this->updateConversions((object) [
                'product_id' => $params->productId,
                'unitPrice' => $nextActiveBatch->unit_price
            ]);

            Product::where('product_id', $defaultRetail->product_id)
                ->update([
                    'current_unit_price' => $defaultRetail->unit_price
                ]);
        }

        (new BranchTable)->addToQueue(['purchase_details', 'products']);
    }

    public function updateConversions($params = [])
    {
        $defaultRetail = '';

        // Product::find($params->productId)->update([
        //     'unit_price' => $params->unitPrice,
        // ]);
        
        $unitConversions = UnitConversion::where('product_id', $params->productId)
            ->where('unit_price', '>', 0)
            ->where('unit_conversions.branch_code', Auth::user()->branch_code)
            ->select('unit_conversions.id as unit_conversion_id', 'quantity', 'equivalent_id', 'default_retail', 'unit_price', 'product_id')
            ->get();
        
        foreach ($unitConversions as $unitConversion) {

            $unitPrice = $params->unitPrice / $unitConversion->quantity;

            UnitConversion::where('equivalent_id', $unitConversion->equivalent_id)
                ->where('product_id', $params->productId)
                ->where('unit_price', '>', 0)
                ->update([
                    'unit_price' => $unitPrice,
                ]);
            
            if ($unitConversion->default_retail == 1) {
                $unitConversion->unit_price = $unitPrice;
                $defaultRetail = $unitConversion; 
            }
        }

        (new BranchTable)->addToQueue(['unit_conversions']);

        return $defaultRetail;
    }
}
