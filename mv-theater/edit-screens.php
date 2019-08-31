<?php
require("../config/autoload.php");

$sec = new Secure;
$sec->checkTSign();

$thr_id = $_POST['thr_id'];

$gd = new getData;
$screen = new Screens;
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
                $screenProps = $screen->returnScreens($thr_id);
                if (count($screenProps) > 0) {
                    foreach($screenProps as $screenProp) : ?>
                        <tr id="row-<?= $i ?>">
                            <td>
                                <label for="<?=$screenProp['thr_screen_id'] ?>"><?=$screenProp['thr_screen_name'] ?></label>
                                <input class="form-control field-width" type="text" id="<?=$screenProp['thr_screen_id'] ?>"
                                       name="screen-name"
                                       placeholder="Screen Name">
                            </td>
                            <td>
                                <label for="seat-<?=$screenProp['thr_screen_id'] ?>">Seats</label>
                                <input class="form-control field-width" type="number" id="seat-<?=$screenProp['thr_screen_id'] ?>"
                                       name="screen-seats"
                                       placeholder="Screen Seats">
                            </td>
                            <td>
                                <button onclick="init(this.id)" class="btn btn-dark" type="button" id="<?=$screenProp['thr_screen_id'] ?>">
                                    Intialize
                                </button>
                            </td>
                        </tr>
                    <?php $i++; endforeach;
                }
                ?>
            </table>
        </div>
    </form>
    <script>

    </script>
<?php else : ?>
    <h4>All Screens Initialized</h4>
<?php endif ?>