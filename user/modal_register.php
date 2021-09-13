<div class="bs-example">
    <!-- Modal For User Register -->
    <div id="modal_register" class="user_modal modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Κάνε την Εγγραφή σου</h5>
                    <i id="icon_register" class='bx bxs-pencil'></i>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_register_email">Email</label><span class="required"> *</span>
                                <input type="email" class="form-control " id="user_register_email" autocomplete="off">
                                <p class="error_form" id="user_register_email_error"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="user_register_name">Όνομα</label><span class="required"> *</span>
                                <input type="text" class="form-control" id="user_register_name" autocomplete="off">
                                <p class="error_form" id="user_register_name_error"></p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_register_surname">Επώνυμο</label><span class="required"> *</span>
                                <input type="text" class="form-control" id="user_register_surname" autocomplete="off">
                                <p class="error_form" id="user_register_surname_error"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="user_register_phone">Κινητό</label><span class="required"> *</span>
                                <input type="text" class="form-control " id="user_register_phone" autocomplete="off">
                                <p class="error_form" id="user_register_phone_error"></p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_register_city">Πόλη</label><span class="required"> *</span>
                                <select id="user_register_city" class="form-select">
                                    <option selected value="0">-- Επιλέξτε --</option>
                                    <option value="1">Πάτρα</option>
                                    <option value="2">Αθήνα</option>
                                    <option value="3">Θεσσαλονίκη</option>
                                </select>
                                <p class="error_form" id="user_register_city_error"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_register_password">Κωδικός Πρόσβασης</label><span class="required"> *</span>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="user_register_password" autocomplete="off">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i onclick="show_hide_password()" id="eye" class="bi bi-eye-fill"></i></span>
                                    </div>
                                </div>
                                <p class="error_form" id="user_register_password_error"></p>
                                <div class="password_strength_container">
                                    <p>Ισχύς Κωδικού Πρόσβασης: <span id="result"> </span></p>
                                    <div class="progress">
                                        <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li class=""><span class="low-upper-case"><i class="fa fa-times" aria-hidden="true"></i></span>&nbsp; Τουλάχιστον 1 μικρό &amp; 1 κεφαλαίο γράμμα</li>
                                        <li class=""><span class="one-number"><i class="fa fa-times" aria-hidden="true"></i></span> &nbsp;Τουλάχιστον 1 αριθμό (0-9)</li>
                                        <li class=""><span class="one-special-char"><i class="fa fa-times" aria-hidden="true"></i></span> &nbsp;Τουλάχιστον 1 ειδικό χαρακτήρα (!@#$%^&*).</li>
                                        <li class=""><span class="eight-character"><i class="fa fa-times" aria-hidden="true"></i></span>&nbsp; Τουλάχιστον 8 χαρακτήρες</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_register_confirm_password">Επιβεβαίωση Κωδικού</label><span class="required"> *</span>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="user_register_confirm_password" autocomplete="off">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i onclick="show_hide_confirm_password()" id="eye_slash" class="bi bi-eye-fill"></i></span>
                                    </div>
                                </div>
                                <p class="error_form" id="user_register_confirm_password_error"></p>
                            </div>
                        </div>

                        <div>
                            <p class="link_already_user_member">Είστε ήδη μέλος;</p>
                            <a href="#" class="link_already_user_member" id="already_member">Σύνδεση</a>
                        </div>

                        <div class="modal-footer">
                            <div class="form-group col-md-12">
                                <button type="button" id="btn_register_user" class="btn btn-warning btn-lg btn-block">Εγγραφή</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
