<?php
$current_page = basename($_SERVER['PHP_SELF']);

function isProfilePage() {
    global $current_page;
    return $current_page == 'profile.php' || $current_page == 'profile_edit.php';
}

function isChallengePage() {
    global $current_page;
    return $current_page == 'challenge.php' || $current_page == 'challenge_edit.php';
}

function isKpiPage(){
    global $current_page;
    return $current_page == 'kpi.php' || $current_page == "kpi_edit.php" ||
           $current_page == "activity.php" || $current_page == "activity_edit.php" ||
           $current_page == "competition.php" || $current_page == "competition_edit.php" ||
           $current_page == "certification.php" || $current_page == "certification_edit.php";
}

echo '<div class="sidenav" id="mySidenav">
    <a href="index.php" class="' . ($current_page == 'index.php' ? 'active' : '') . '"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="profile.php" class="' . (isProfilePage() ? 'active' : '') . '"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
    <a href="kpi.php" class="' . (isKpiPage() ? 'active' : '') . '"><i class="fa fa-book" aria-hidden="true"></i> KPI</a>
    <a href="activity_search.php" class="' . ($current_page == 'activity_search.php' ? 'active' : '') . '"><i class="fa fa-search" aria-hidden="true"></i> Activities</a>
    <a href="challenge.php" class="' . (isChallengePage() ? 'active' : '') . '"><i class="fa fa-flag" aria-hidden="true"></i> Challenge</a>
    <a href="logout.php" onClick="return confirm(\'Logout?\');"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
</div>';
?>