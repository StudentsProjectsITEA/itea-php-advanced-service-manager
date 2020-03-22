<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container person-cabinet">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                       href="#my-services" role="tab" aria-controls="home">My Services</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                       href="#favorites" role="tab" aria-controls="profile">Favorites</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                       href="#personal-information" role="tab" aria-controls="messages">Personal Information</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                       href="#change-pass" role="tab" aria-controls="settings">Change password</a>

                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="my-services" role="tabpanel">
                        <div class="container services-list">
                            <div class="row row-cols-1 row-cols-md-3">
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="assets/imgs/default.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a longer card with supporting text below as a
                                                natural lead-in to additional content. This content is a little bit
                                                longer.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="assets/imgs/default.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a longer card with supporting text below as a
                                                natural lead-in to additional content. This content is a little bit
                                                longer.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="assets/imgs/default.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a longer card with supporting text below as a
                                                natural lead-in to additional content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="assets/imgs/default.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a longer card with supporting text below as a
                                                natural lead-in to additional content. This content is a little bit
                                                longer.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="assets/imgs/default.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a longer card with supporting text below as a
                                                natural lead-in to additional content. This content is a little bit
                                                longer.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="favorites" role="tabpanel">
                        <div class="container services-list">
                            <div class="row row-cols-1 row-cols-md-3">
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="assets/imgs/default.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a longer card with supporting text below as a
                                                natural lead-in to additional content. This content is a little bit
                                                longer.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="assets/imgs/default.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a longer card with supporting text below as a
                                                natural lead-in to additional content. This content is a little bit
                                                longer.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="personal-information" role="tabpanel">
                        <form>
                            <img src="assets/imgs/default.jpg" alt="..." class="img-thumbnail">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input type="text" class="form-control" id="exampleInputName">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSurname">Surname</label>
                                <input type="text" class="form-control" id="exampleInputSurname">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPhone">Phone</label>
                                <input type="text" class="form-control" id="exampleInputPhone">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="change-pass" role="tabpanel">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Old Password</label>
                                <input type="email" class="form-control" id="exampleInputPassword1">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2">New Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword2">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword3">Confirm New Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword3">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    $js = <<<JS
        $('#myList a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    JS;
    $this->registerJs($js);
?>