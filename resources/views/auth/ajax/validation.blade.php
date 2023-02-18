<div class="form-group row"><label class="col-sm-3 col-form-label">Business Code <span class="text-danger pull-right">*</span></label>
    <div class="col-sm-6">
        <input id="code" onkeyup="validateCode(this.value)" id="email" type="text" autocomplete="nope" class="form-control" placeholder="**********" required=""  autofocus>
    </div>
</div>

<div id="validation_container"></div>


<script type="text/javascript">
     $("#code").focus();

    function validateCode(code)
    {
        if (code.length >= 10) {
            loadPage('/validate-code/'+code, 'validation_container');
        }
    }
</script>

