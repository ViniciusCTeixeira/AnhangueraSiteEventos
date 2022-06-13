<section class="page-full">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card bg-light border-1">
                    <div class="card-header bg-transparent pb-2">
                        <h3 class="text-center mt-2"><?= __('Cadastre-se') ?></h3>
                    </div>
                    <div class="card-body px-lg-5 py-lg-2">
                        <?= $this->Form->create(NULL, ['id' => 'UserRegister', 'class' => 'j-forms', 'enctype' => "multipart/form-data", 'url' => ['controller' => 'Users', 'action' => 'register']]); ?>
                        <?php $this->Form->setTemplates(['inputContainer' => '{{content}}']); ?>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <?= $this->Form->control('name', ['id' => '', 'type' => 'text', 'class' => 'form-control', 'label' => FALSE, 'placeholder' => __('Nome')]) ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <?= $this->Form->control('email', ['id' => '', 'type' => 'email', 'class' => 'form-control', 'label' => FALSE, 'placeholder' => __('E-Mail')]) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <?= $this->Form->control('password', ['id' => '', 'type' => 'password', 'class' => 'form-control', 'label' => FALSE, 'placeholder' => __('Senha')]) ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <?= $this->Form->control('cpf', ['id' => '', 'type' => 'text', 'class' => 'form-control cpf', 'label' => FALSE, 'placeholder' => __('CPF')]) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <input type="radio" class="isStudent" id="student" name="isStudent" value="1">
                                <label for="student"><?= __('Sou aluno') ?></label>
                                <input type="radio" class="isStudent" id="student2" name="isStudent" value="0"
                                       checked="checked">
                                <label for="student2"><?= __('Não sou aluno') ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <?= $this->Form->control('ra', ['id' => '', 'type' => 'text', 'class' => 'form-control ra hide', 'label' => FALSE, 'placeholder' => __('RA')]) ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 text-right mb-3">
                                <button type="submit" class="btn btn-success btn-submit"><?= __('Cadastrar') ?></button>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->start('custom_script'); ?>
<script>
    $(function () {
        $('.navbar-area').css({position: 'unset'})

        $('.isStudent').on('change', function () {
            if ($('.isStudent:checked').val() == 1) {
                $('.ra').removeClass('hide')
            } else {
                $('.ra').addClass('hide')
            }
        })

        $("#UserRegister").validate({
            errorClass: 'error-view',
            validClass: 'success-view',
            errorElement: 'span',
            rules: {
                'name': {
                    required: true,
                },
                'email': {
                    required: true,
                    email: true,
                },
                'password': {
                    required: true,
                    minlength: 8
                },
                'cpf': {
                    required: true,
                    minlength: 14,
                    maxlength: 14
                },
                'ra': {
                    required: function () {
                        $('.isStudent').on('change', function () {
                            if ($('.isStudent:checked').val() == 1) {
                                return true;
                            } else {
                                return false;
                            }
                        })
                    },
                    minlength: 12,
                    maxlength: 12
                }
            },
            messages: {
                'name': {
                    required: 'Informe seu nome'
                },
                'email': {
                    required: 'Informe seu email',
                    email: 'Email inválido'
                },
                'password': {
                    required: 'Informe seu email',
                    minlength: 'Por favor, insira pelo menos {0} caracteres.',
                },
                'cpf': {
                    required: 'Informe seu CPF',
                    minlength: 'Por favor, insira seu cpf completo.',
                    maxlength: 'Por favor, insira seu cpf completo.'
                },
                'ra': {
                    maxlength: 'Por favor, indique não mais do que {0} caracteres.',
                    minlength: 'Por favor, insira pelo menos {0} caracteres.',
                    required: 'Informe seu RA'
                }
            },
            highlight : function (element, errorClass, validClass){
                $(element).closest('.input').removeClass(validClass).addClass(errorClass);
                if ($(element).is(':checkbox') || $(element).is(':radio')) {
                    $(element).closest('.check').removeClass(validClass).addClass(errorClass);
                }
            },
            unhighlight : function (element, errorClass, validClass){
                $(element).closest('.input').removeClass(errorClass).addClass(validClass);
                if ($(element).is(':checkbox') || $(element).is(':radio')) {
                    $(element).closest('.check').removeClass(errorClass).addClass(validClass);
                }
            },
            errorPlacement : function (error, element){
                $(element).after(error);
            },
            invalidHandler: function (event, validator) {
                let errors = validator.numberOfInvalids();

                application.pnotify('notice', 'Ops, ' + ((errors === 1) ? 'existe' : 'existem') + ' ' + errors + ' campo' + ((errors === 1) ? '' : 's') + ' precisando de atenção.');
            },
            submitHandler: function () {
                $('#UserRegister').ajaxSubmit({
                    target: '#UserRegister',
                    dataType: 'json',
                    error: function (xhr) {
                        $('.btn-submit').attr('disabled', false).removeClass('processing');
                        application.showAlert('warning', 'Por favor, tente novamente.', 'Algo de errado aconteceu');
                    },
                    beforeSubmit: function () {
                        $('.btn-submit').attr('disabled', true).addClass('processing');
                    },
                    success: function (res) {
                        $('.btn-submit').attr('disabled', false).removeClass('processing');
                        if (res.success) {
                            $('#UserRegister .input').removeClass('success-view error-view');
                            $('#UserRegister .check').removeClass('success-view error-view');
                            application.showAlert('successRedirect', res.msg, res.title, res.redirect);
                        } else {
                            application.showAlert('warning', res.msg, res.title);
                        }
                    }
                });
            }
        });
    })
    ;
</script>
<?php $this->end(); ?>
