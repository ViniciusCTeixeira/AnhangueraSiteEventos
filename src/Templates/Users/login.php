<section class="page-full">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-light border-1">
                    <div class="card-header bg-transparent pb-2">
                        <h3 class="text-center mt-2"><?= __('Login') ?></h3>
                    </div>
                    <div class="card-body px-lg-5 py-lg-2">
                        <?= $this->Form->create(NULL, ['id' => 'UserLogin', 'class' => 'j-forms', 'enctype' => "multipart/form-data", 'url' => ['controller' => 'Users', 'action' => 'login']]); ?>
                        <?php $this->Form->setTemplates(['inputContainer' => '{{content}}']); ?>

                        <div class="form-group mb-3">
                            <?= $this->Form->control('email', ['id' => '', 'type' => 'email', 'class' => 'form-control', 'label' => FALSE, 'placeholder' => __('E-Mail')]) ?>
                        </div>
                        <div class="form-group mb-3">
                            <?= $this->Form->control('password', ['id' => '', 'type' => 'password', 'class' => 'form-control', 'label' => FALSE, 'placeholder' => __('Senha')]) ?>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-default-site mt-4"><?= __('Entrar') ?></button>
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
            $('.navbar-area').css({position:'unset'})
        });
    </script>
<?php $this->end(); ?>
