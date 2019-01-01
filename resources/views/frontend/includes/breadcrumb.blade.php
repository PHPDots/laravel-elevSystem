<ol class="breadcrumb">
    <li>
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-home"></i>
        </a>
    </li>
    <?php
        if(isset($pageTitle)){
            echo breadcrumb($pageTitle);
        }
    ?>
</ol>