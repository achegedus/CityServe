<template>
    <!--=== Footer v7 ===-->
    <section id="footer-v7" class="contacts-section">
        <div class="container content-lg">
            <div class="row contacts-in">
                <div class="col-md-6 md-margin-bottom-40">
                    <ul class="list-unstyled">
                        <li><i class="fa fa-home"></i> 201 Harvest Fields Drive, Boalsburg, PA 16827</li>
                        <li><i class="fa fa-phone"></i> (814)238-0822 ext. 20</li>
                        <li><i class="fa fa-envelope"></i> <a href="info@sc-cityserve.org">info@sc-cityserve.org</a></li>
                        <li><i class="fa fa-globe"></i> <a href="http://htmlstream.com">www.sc-cityserve.org</a></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <form action="assets/php/sky-forms-pro/demo-contacts-process.php" method="post" id="sky-form3" class="sky-form">
                        <fieldset>
                            <label>Name</label>
                            <div class="row">
                                <div class="col-md-7 margin-bottom-20 col-md-offset-0">
                                    <div>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <label>Email <span class="color-red">*</span></label>
                            <div class="row">
                                <div class="col-md-7 margin-bottom-20 col-md-offset-0">
                                    <div>
                                        <input type="text" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <label>Message</label>
                            <div class="row">
                                <div class="col-md-11 margin-bottom-20 col-md-offset-0">
                                    <div>
                                        <textarea rows="8" name="message" id="message" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <p><button type="submit" class="btn-u btn-brd btn-brd-hover btn-u-dark">Send Message</button></p>
                        </fieldset>

                        <div class="message">
                            <i class="rounded-x fa fa-check"></i>
                            <p>Your message was successfully sent!</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="copyright-section">
            <p>2017 &copy; All Rights Reserved</p>
            <ul class="social-icons">
                <li><a href="#" data-original-title="Facebook" class="social_facebook rounded-x"></a></li>
                <li><a href="#" data-original-title="Twitter" class="social_twitter rounded-x"></a></li>
                <li><a href="#" data-original-title="Goole Plus" class="social_googleplus rounded-x"></a></li>
            </ul>
            <a href="#top"><i class="fa fa-angle-double-up back-to-top"></i></a>
        </div>
    </section>
    <!--=== End Footer v7 ===-->
</template>


<style>

</style>


<script>

    export default{
        data(){
            return{
                msg:'hello vue'
            }
        }
    }

</script>
