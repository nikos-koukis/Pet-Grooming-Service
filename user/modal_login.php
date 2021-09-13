

    <!-- Modal For User Login -->
    <div id="modal_login" class="user_modal modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Κάνε Σύνδεση</h5>
                    <i id="icon_login" class='bx bx-log-in'></i>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_email">Email</label><span class="required"> *</span>
                                <input type="email" class="form-control " id="user_email" name="user_email" autocomplete="off"  >
                                <p class="error_form" id="user_email_error"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_password">Κωδικός Πρόσβασης</label><span class="required"> *</span>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="user_password" name="user_password" autocomplete="off">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i onclick="show_hide_password_modal_login()" id="eye" class="bi bi-eye-fill"></i></span>
                                    </div>
                                </div>
                                <p class="error_form" id="user_password_error"></p>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="user_remember_me" name="user_remember_me" >
                            <label class="form-check-label" for="user_remember_me">
                                <b>Να με θυμάσαι</b>
                            </label>
                        </div>
                        <div id="links">
                            <p class="forget_password">Ξεχάσατε τον κωδικό σας;</p>
                            <a href="user/user_forget_password.php" class="forget_password">Επαναφορά</a>
                        </div>
                        <div>
                            <p class="link_not_member">Δεν έχετε λογαριασμό;</p>
                            <a href="#" class="link_not_member">Εγγραφείτε</a>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="form-group col-md-12">
                            <button type="button" id="btn_user_login" class="btn btn-primary btn-block">Συνδέσου</button>
                            <p class="error_form" id="user_invalid_credits_error"></p>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

