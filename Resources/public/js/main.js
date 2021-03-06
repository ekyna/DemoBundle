require(['require', 'jquery', 'ekyna-cms/user', 'ekyna-social-buttons/share', 'bootstrap', 'bootstrap/hover-dropdown'], function(require, $, User) {

    User.init();

    // Forms
    var $forms = $('.form-body');
    if ($forms.size() > 0) {
        require(['ekyna-form'], function(Form) {
            $forms.each(function(i, f) {
                var form = Form.create(f);
                form.init();
            });
        });
    }
});
