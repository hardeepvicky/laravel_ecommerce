<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum"); ?>
        </div>
        <div class="col-md-3" style="text-align: right; padding-top : 5px;">
            <span class="btn blue-madison btn-circle" id="clear-cache">Clear Cache</span>
        </div>
    </div>
</div>
<style>
    .first-row
    {
        border-top: 2px solid #4c667f;
    }
</style>
<?php echo $this->Session->flash(); ?>

<div class="form__structure">
    <?php
    echo $this->Form->create($model, array(
        'type' => 'file',
        "class" => "form-horizontal form-row-seperated",
        'inputDefaults' => array(
            'label' => false, 'div' => false, 'div' => false, "escape" => false,
            "class" => "form-control", "type" => "text"
        )
    ));
    ?>

    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Group <span>*</span> :</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
                <?=
                $this->Form->input('group_id', array(
                    "id" => "group_id",
                    "type" => "select",
                    "class" => "form-control select2me",
                    'options' => $group_list,
                    'multiple' => true,
                ));
                ?>
            </div>
        </div>

        <div id="permission_block">
            <div class="table-responsive">
                <table class="table table-striped table-bordered order-column sr-databtable">
                    <thead>
                        <tr>
                            <th data-search-clear="1"style="width : 6%">#</th>
                            <th data-search="1" style="width : 25%">Section</th>
                            <th data-search="1" style="width : 40%">Action</th>
                            <th data-search="1">Parent Screen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0;
                        foreach($sections as $section_name => $section_subs): 
                            $section_name = trim($section_name);
                            $section_name_str = str_replace(" ", "_", $section_name);
                        ?>
                            <?php 
                            $a = 0;
                            foreach($section_subs as $section_sub_name => $arr):
                                $a++;
                                $i++;

                                $section_sub_name = trim($section_sub_name);
                                $section_sub_name_str = str_replace(" ", "_", $section_sub_name);

                                if (is_array($arr))
                                {
                                    $url = isset($arr["url"]) ? $arr["url"] : "";
                                }
                                else
                                {
                                    $url = $arr;
                                }

                                $tr_cls = $a == 1 ? "first-row" : "";
                            ?>
                            <tr class="<?= $tr_cls ?>">
                                <td class="text-center"><?= $i ?></td>
                                <td>
                                    <?php if ($a == 1): ?>
                                        <label class="for-checkbox">
                                            <input type="checkbox" class="chk-select-all" data-href="input.controller-<?= $section_name_str ?>">
                                            <b><?= $section_name ?></b>
                                        </label>
                                    <?php else: ?>
                                        <?= $section_name ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($url): ?>
                                    <label class="for-checkbox">
                                        <input type="checkbox"
                                               id="action-<?= $section_name_str ?>-<?= $section_sub_name_str ?>"
                                               class="checkbox-css-toggler controller-<?= $section_name_str ?>" 
                                               name="data[Permissions][<?= $url ?>]" 
                                               data-toggler-target="span.realted-action-<?= $section_name_str ?>-<?= $section_sub_name_str ?>" 
                                               data-toggler-class="font-green-meadow" />
                                        <?= $section_sub_name ?>
                                    </label>
                                    <?php else: ?>
                                        <?= $section_sub_name ?>
                                        <br/>URL not Found
                                    <?php endif; ?>
                                </td>
                                <?php if (is_array($arr) && isset($arr["related"])) : ?>
                                    <td>
                                        <?php
                                        foreach($arr["related"] as $inner_arr):
                                            $inner_arr["title"] = trim($inner_arr["title"]);
                                            $inner_arr["sub_title"] = trim($inner_arr["sub_title"]);

                                            $realted_name = $inner_arr["title"] . "->" . $inner_arr["sub_title"];

                                            $related_section_name = str_replace(" ", "_", $inner_arr["title"]);
                                            $related_sub_name = str_replace(" ", "_", $inner_arr["sub_title"]);
                                        ?>
                                            <span class="realted-action realted-action-<?= $related_section_name ?>-<?= $related_sub_name ?>" data-section="<?= $related_section_name ?>" data-section-sub="<?= $related_sub_name ?>">
                                                <?= $realted_name ?>
                                            </span>
                                            <br/>
                                        <?php endforeach; ?>
                                    </td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
            <button type="submit" href="javascript:;" class="btn blue">Submit</button>
            <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#clear-cache").click(function()
        {
            $.get("/<?= $controller ?>/create", function(response)
            {
                bootbox.alert(response);
            });
        });
    });
</script>