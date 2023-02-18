<?php

namespace App\Http\Services;

use Auth;
use App\Models\Product;
use App\Models\Material;
use App\Models\PurchaseDetail;
use App\Models\UnitConversion;
use App\Models\BranchTable;

class MaterialService
{  
    public function updateStocks($params = [])
    {   
        
        $ctr = 0;

        $purchaseDetails = PurchaseDetail::join('material_suppliers', 'material_suppliers.id', 'purchase_details.material_supplier_id')
            ->select('purchase_details.id as purchase_detail_id', 'purchase_details.*')
            ->where('material_suppliers.material_id', $params->materialId)
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
                        'materialId' => $params->materialId,
                        'unitPrice' => $purchaseDetail->unit_price
                    ]);
                }
                
                $newConsumed = $purchaseDetail->available < $newConsumed ? ($newConsumed - $purchaseDetail->available) : 0;
                $ctr++;
            }
        }

        $activeBatch = (new PurchaseDetail)->findActiveBatch($purchaseDetail->material_id);

        if ((count($purchaseDetails) > $ctr) && !$activeBatch) {
            
            $nextActiveBatch = PurchaseDetail::join('material_suppliers', 'material_suppliers.id', 'purchase_details.material_supplier_id')
                ->where('material_suppliers.material_id', $params->materialId)
                ->where('available', '>', 0)
                ->where('purchase_details.branch_code', Auth::user()->branch_code)
                ->select('purchase_details.*')
                ->first();

            $nextActiveBatch->update([
                'batch_status' => 'Active'
            ]);

            $defaultRetail = $this->updateConversions((object) [
                'materialId' => $params->materialId,
                'unitPrice' => $nextActiveBatch->unit_price
            ]);

            Product::where('material_id', $defaultRetail->material_id)
                ->update([
                    'current_unit_price' => $defaultRetail->unit_price
                ]);
        }

        (new BranchTable)->addToQueue(['purchase_details', 'products']);
    }


    public function updateConversions($params = [])
    {
        $defaultRetail = '';

        Material::find($params->materialId)->update([
            'unit_price' => $params->unitPrice,
        ]);
        
        $unitConversions = UnitConversion::where('material_id', $params->materialId)
            ->where('unit_price', '>', 0)
            ->where('unit_conversions.branch_code', Auth::user()->branch_code)
            ->select('unit_conversions.id as unit_conversion_id', 'quantity', 'equivalent_id', 'default_retail', 'unit_price', 'material_id')
            ->get();
        
        foreach ($unitConversions as $unitConversion) {

            $unitPrice = $params->unitPrice / $unitConversion->quantity;

            UnitConversion::where('equivalent_id', $unitConversion->equivalent_id)
                ->where('material_id', $params->materialId)
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
