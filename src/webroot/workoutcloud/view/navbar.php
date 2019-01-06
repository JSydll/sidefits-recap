<?php
// NAVBAR ////////////////////////////////////////////////////////////
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" ng-controller="navCtrl">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" ng-init="navCollapsed = true" ng-click="navCollapsed = !navCollapsed">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" ui-sref="content.home"><img id="navbar-brand-img" src="images/app/Icon.png" alt="Sidefits" /></a>
        <!-- Site status -->
        <div class="navbar-text" style="white-space: nowrap; font-size: 1.0em">
            <span>Sidefits WorkoutCloud</span>
        </div>
      </div>

      <div id="navpane" class="collapse navbar-collapse" ng-class="!navCollapsed && 'in'">
        <ul class="nav navbar-nav navbar-right" ng-if="!$state.includes('content.search')">
            <li><a data-toggle="collapse" data-target="{{navCollapsed?'#gobalSearchDesktop':'#gobalSearchMobile'}}"><i class="fa fa-search icon-xl"></i>  &nbsp;&nbsp; <span ng-if="!navCollapsed" translate="SEARCH"></span></a></li>
            <li><div id="gobalSearchMobile" class="collapse">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control global-search-input" ng-model="globalSearch" placeholder="{{ 'SEARCH' | translate }}" />
                        <span class="input-group-btn">
                            <button type="submit" ng-click="startGlobalSearch(this)" class="btn btn-primary global-search-btn" ng-disabled="!globalSearch.length"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div></li>
        </ul>
        <!-- User not logged in -->
        <ul class="nav navbar-nav navbar-right" ng-if="!isAuthenticated()">
            <li><a ui-sref="modal.explain"><i class="fa fa-question icon-xl"></i><span class="hidden-sm hidden-md hidden-lg" uib-tooltip="Explainer Video" uib-tooltip-trigger="outsideClick" uib-tooltip-placement="bottom"> &nbsp;&nbsp; Explainer Video</span></a></li>
            <li class="dropdown" dropdown>
                <a class="dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>{{ 'EXPLORE' | translate }} <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu" role="menu" style="margin-top: 4px; min-width: 200px">
                    <li><a ui-sref="content.partners"><i class="fa fa-thumbs-o-up icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="PARTNERS"></span></a></li>
                    <li><a ui-sref="modal.slackapp"><i class="fa fa-slack icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="GET_SLACKAPP"></span></a></li>
                    <li class="divider"></li>
                    <li><a ui-sref="modal.sportsscientist"><i class="fa fa-flask icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="OUR_SPORTSSCIENTIST"></span></a></li>
                    <li><a ui-sref="modal.faq"><i class="fa fa-question icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="FAQ"></span></a></li>
                    <li class="divider"></li>
                    <li><a ui-sref="modal.contact"><i class="fa fa-envelope-o icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="CONTACT"></span></a></li>
                    <li><a ui-sref="modal.feedback"><i class="fa fa-commenting-o icon-xl text-muted"></i> &nbsp;&nbsp; <span>Feedback</span></a></li>
                </ul>
            </li>
            <li><a class="btn disabled"><i class="glyphicon glyphicon-heart icon-xl"></i><span class="hidden-sm hidden-md hidden-lg" uib-tooltip="Please log in to see your favorites." uib-tooltip-trigger="outsideClick" uib-tooltip-placement="bottom"> &nbsp;&nbsp; Favoriten</span></a></li>
            <li><a ui-sref="modal.login" class="btn"><i class="glyphicon glyphicon-log-in icon-xl"></i><span> &nbsp;&nbsp; Login</span></a></li>
        </ul>
        <!-- User is logged in -->
        <ul class="nav navbar-nav navbar-right" ng-if="isAuthenticated()">
          <li><a ui-sref="modal.explain"><i class="fa fa-question icon-xl"></i><span class="hidden-sm hidden-md hidden-lg" uib-tooltip="Explainer Video." uib-tooltip-trigger="outsideClick" uib-tooltip-placement="bottom"> &nbsp;&nbsp; Explainer Video</span></a></li>
          <li class="dropdown" dropdown>
                <a class="dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>{{ 'EXPLORE' | translate }} <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu" role="menu" style="margin-top: 4px; min-width: 200px">
                    <li><a ui-sref="content.partners"><i class="fa fa-thumbs-o-up icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="PARTNERS"></span></a></li>
                    <li class="divider"></li>
                    <li><a ui-sref="modal.faq"><i class="fa fa-question icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="FAQ"></span></a></li>
                    <li class="divider"></li>
                    <li><a ui-sref="modal.contact"><i class="fa fa-envelope-o icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="CONTACT"></span></a></li>
                    <li><a ui-sref="modal.feedback"><i class="fa fa-commenting-o icon-xl text-muted"></i> &nbsp;&nbsp; <span>Feedback</span></a></li>
                </ul>
            </li>
          <li><a ui-sref="content.favorites" ui-sref-active="active" uib-tooltip="{{ 'FAVORITES' | translate }}" uib-tooltip-trigger="outsideClick" uib-tooltip-placement="bottom">
                    <i class="glyphicon glyphicon-heart icon-xl hover-red"></i><span class="hidden-sm hidden-md hidden-lg"> &nbsp;&nbsp; {{ 'FAVORITES' | translate }}</span></a></li>
          <li class="dropdown" dropdown>
            <a id="user-dropdown" class="dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img id="navbar-user-img" class="img-circle" ng-src="images/user/profile/{{me.picPath}}"/>  &nbsp;&nbsp;<span class="hidden-sm hidden-md hidden-lg">{{me.name}}</span> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu" style="min-width: 300px;">
              <li><blockquote>
                        <span class="text-muted hidden-xs" >
                            <h5><i>{{me.shortBio}}</i></h5>
                        </span>
                        <span class="hidden-sm hidden-md hidden-lg white-text" >
                            <h5><i>{{me.shortBio}}</i></h5>
                        </span>
                    </blockquote></li>
                <li class="divider"></li>
                <li><a ui-sref="content.followers" >
                        <i class="fa fa-users icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="FOLLOWERS"></span>
                    </a>
                </li>
                <li class="divider"></li>
                <li><a ui-sref="content.profile">
                        <i class="glyphicon glyphicon-cog icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="PROFILE"></span>
                    </a>
                </li>
                <li class="divider"></li>
                <li><a ui-sref="modal.logout">
                        <i class="glyphicon glyphicon-log-out icon-xl text-muted"></i> &nbsp;&nbsp; <span translate="LOGOUT"></span>
                    </a>
                </li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>
</nav>
<!-- Global search desktop-->
<div id="gobalSearchDesktop" class="collapse container" ng-controller="navCtrl">
    <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control global-search-input" ng-model="globalSearch" placeholder="{{ 'SEARCH' | translate }}" />
                    <span class="input-group-btn">
                        <button type="submit" ng-click="startGlobalSearch(this)" class="btn btn-primary global-search-btn" ng-disabled="!globalSearch.length"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-xs-3"></div>
    </div>
</div>
