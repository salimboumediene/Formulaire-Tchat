<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input type="text"
           class="form-control"
           name="<?= \App\Form\Form::NAME_EMAIL ?>"
           placeholder="Email"
           value="<?= (string) filter_var($user->email, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>">
</div>