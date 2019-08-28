<?php
require("../config/autoload.php");

$sec = new Secure;
$sec->checkTSign();

$thr_id = $_POST['thr_id'];

$gd = new getData;
$screen = new Screens;
$thr_screens = $gd->getScreenDetails($thr_id);
$status = $screen->checkScreenInitial($thr_id);
?>
<?php if (!$status) : ?>
    <form class="col- col-sm col-md col-lg col-xl form-movie mx-auto d-block">
        <div class="add-info table-responsive">
            <label class="btn btn-danger" id="InitializeScreens">
                Initialize Screens
            </label>
            <table class="table">
                <?php
                $i = 1;
                while ($i <= $thr_screens) : ?>
                    <tr id="row-<?=$i?>">
                        <td>
                            <input class="form-control field-width" type="text" id="name-<?= $i ?>" name="screen-name"
                                   placeholder="Screen Name">
                        </td>
                        <td>
                            <input class="form-control field-width" type="number" id="seat-<?= $i ?>" name="screen-seats"
                                   placeholder="Screen Seats">
                        </td>
                        <td>
                            <button onclick="init(this.id)" class="btn btn-dark" type="button" id="<?= $i ?>">Intialize</button>
                        </td>
                    </tr>
                    <?php $i++; endwhile; ?>
            </table>
        </div>
    </form>
<script>

</script>
<?php else : ?>
    <h4>All Screens Initialized</h4>
<?php endif ?>