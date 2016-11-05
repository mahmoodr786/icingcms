<?php
use Phinx\Seed\AbstractSeed;

/**
 * Roles seed.
 */
class RolesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $headers = ['id', 'name', 'created', 'modified'];
        $rows = [
            ['1', 'Admin', '2015-12-29 09:09:23', '2015-12-29 09:09:23'],
            ['2', 'Registered', '2015-12-29 09:09:23', '2015-12-29 09:09:23'],
            ['3', 'Public', '2015-12-29 09:09:23', '2015-12-29 09:09:23'],
        ];

        foreach ($rows as $row) {
            $data[] = array_combine($headers, $row);
        }
        $table = $this->table('roles');
        $table->insert($data)->save();
    }
}
