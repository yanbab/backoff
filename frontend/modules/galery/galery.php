<?php

$galery = db_get("SELECT * FROM galery WHERE id_page = '$page[id]' AND status = 1 ORDER BY position");
