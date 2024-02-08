<?php

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;

return new class {

  public function up(Schema $schema): void {
    $table = $schema->createTable('users');
    $table->addColumn('id', Types::INTEGER, array('unsigned' => true, 'autoincrement' => true));
    $table->setPrimaryKey(array('id'));
    $table->addColumn('name', Types::STRING, array('length' => 255));
    $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, array('default' => 'CURRENT_TIMESTAMP'));
  }

  public function down(Schema $schema): void {
    $schema->dropTable('users');
  }
};