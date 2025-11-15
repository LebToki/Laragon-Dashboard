<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Notification</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Settings - Notification</li>
                </ul>
            </div>

            <div class="card h-100 p-0 radius-12 overflow-hidden">
                <div class="card-body p-40">
                    <form action="#">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="firebaseSecretKey" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase secret key</label>
                                    <input type="text" class="form-control radius-8" id="firebaseSecretKey" placeholder="Firebase secret key" value="AAAAxGHw9lE:APA91bHKj6OsrD6EhnG5p26oTiQkXvOxTZwZEfVuuuipyUSNM-a8NB_CugVwfvvaosOvWgFAhQJOLMvxtv7e3Sw8DYpaWKwJIN3kjyIPoNRAe541sBz3x7E6sXZkA-ebueqnQiqNtbdP">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="firebasePublicVapidKey" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase public vapid key (key pair)</label>
                                    <input type="text" class="form-control radius-8" id="firebasePublicVapidKey" placeholder="Firebase public vapid key (key pair)" value="BKAvKJbnB3QATdp8n1aUo_uhoNK3exVKLVzy7MP8VKydjjzthdlAWdlku6LQISxm4zA7dWoRACI9AHymf4V64kA">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="firebaseAPIKey" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase API Key</label>
                                    <input type="text" class="form-control radius-8" id="firebaseAPIKey" placeholder="Firebase  API Key" value="AIzaSyDg1xBSwmHKV0usIKxTFL5a6fFTb4s3XVM">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="firebaseAuthDomain" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase AUTH Domain</label>
                                    <input type="text" class="form-control radius-8" id="firebaseAuthDomain" placeholder="Firebase  AUTH Domain" value="wowdash.firebaseapp.com">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="firebaseProjectID" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase Project ID</label>
                                    <input type="text" class="form-control radius-8" id="firebaseProjectID" placeholder="Firebase Project ID" value="wowdash.com">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="firebaseStorageBucket" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase Storage Bucket</label>
                                    <input type="text" class="form-control radius-8" id="firebaseStorageBucket" placeholder="Firebase Storage Bucket" value="wowdash.appsport.com">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="firebaseMessageSenderID" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase Message Sender ID</label>
                                    <input type="text" class="form-control radius-8" id="firebaseMessageSenderID" placeholder="Firebase  Message Sender ID" value="52362145">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="firebaseAppID" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase App ID</label>
                                    <input type="text" class="form-control radius-8" id="firebaseAppID" placeholder="Firebase  App ID" value="1:843456771665:web:ac1e3115e9e17ee1582a70">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-20">
                                    <label for="firebaseMeasurmentID" class="form-label fw-semibold text-primary-light text-sm mb-8">Firebase Measurement ID</label>
                                    <input type="text" class="form-control radius-8" id="firebaseMeasurmentID" placeholder="Firebase  Measurement ID" value="G-GSJPS921XW">
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                                <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                                    Save Change
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>