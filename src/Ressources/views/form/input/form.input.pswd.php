<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input type="text"
           class="form-control"
           name="<?= \App\Form\Form::NAME_PSWD ?>"
           placeholder="Password"
           value="<?= (string) filter_var($user->pswd, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>">
</div>