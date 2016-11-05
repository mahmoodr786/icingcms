<?php
use Phinx\Seed\AbstractSeed;

/**
 * Links seed.
 */
class LinksSeed extends AbstractSeed
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
        $headers = ['id', 'menu_id', 'parent_id', 'name', 'url', 'attributes', 'allow_html', 'status', 'order', 'created', 'modified'];
        $rows = [
            ['1', '1', null, 'Documentation <span class="caret"></span>', '/documentation', 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"', '1', '1', '2', '2016-08-30 17:18:53', '2016-09-07 19:48:34'],
            ['2', '1', '1', 'Setup', '/documentation/setup', '', '0', '1', '1', '2016-09-01 13:46:05', '2016-09-07 20:20:49'],
            ['3', '1', null, 'Home', '/', '', '0', '1', '1', '2016-09-06 17:58:16', '2016-09-06 17:58:16'],
        ];

        foreach ($rows as $row) {
            $data[] = array_combine($headers, $row);
        }
        $table = $this->table('links');
        $table->insert($data)->save();
    }
}
