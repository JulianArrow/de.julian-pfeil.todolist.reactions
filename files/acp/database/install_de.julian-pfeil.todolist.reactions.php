<?php

use wcf\system\database\table\PartialDatabaseTable;
use wcf\system\database\table\column\SmallintDatabaseTableColumn;

return [
    PartialDatabaseTable::create('todolist1_todo')
        ->columns([
            SmallintDatabaseTableColumn::create('cumulativeLikes')
                ->length(5)
                ->notNull()
                ->defaultValue(0),
        ]),
];