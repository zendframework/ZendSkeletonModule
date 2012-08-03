
Data Directory
=================

Sql files for your module can be placed here with a filename: "name.dbtype.sql"

name: The name can be anything. It's suggested you use the name 'schema' for sql files
which create compulsory sql, and any other name for optional sql code.

dbtype: This denotes what engine the sql code is for:
  sqlite
  mysql
  postgresql
  sqlserver
  sql92

Examples
---------

 * schema.mysql.sql        compulsory sql code that the modules needs to run

 * featurefoo.sqlite.sql   optional sql code for sqlite which the module can use to add extra feature/s
