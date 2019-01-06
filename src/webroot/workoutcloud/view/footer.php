<?php
// FOOTER ////////////////////////////////////////////////////////////
?>
    <div class="bigspace"></div>
    <div class="footer container-fluid" ng-controller="footerCtrl" ng-cloak>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5">
                        <p class="white-text pull-left">Made by Sidefits with <i class="glyphicon glyphicon-heart icon-l"></i> in Hamburg/ Copenhagen. <br />&copy; 2016</p>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <p class="text-center">
                            <span class="btn white-text pull-left" ng-click="changeLanguage('en_EN')">EN</span>
                            <span class="btn white-text pull-left">|</span>
                            <span class="btn white-text pull-left" ng-click="changeLanguage('de_DE')">DE</span>
                        </p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p class="white-text"><a ui-sref="modal.terms" ui-sref-opts="{location: false}" class="btn"><span class="white-text">Terms</span></a>|
                        <a ui-sref="modal.privacy" ui-sref-opts="{location: false}" class="btn"><span class="white-text">Privacy policy</span></a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script section -->
    <!-- Bootstrap and additional plugins -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap Lightbox -->
    <script language="javascript" type="text/javascript" src="js/vendor/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Overall javascripting -->
    <script language="javascript" type="text/javascript" src="js/script.js"></script>

    </body>
</html>
