<?php
use Phinx\Seed\AbstractSeed;

/**
 * Menus seed.
 */
class MenusSeed extends AbstractSeed
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
        $headers = ['id', 'name', 'key', 'tag', 'tag_attributes', 'list_tag', 'list_tag_attributes', 'dropdown_tag', 'dropdown_tag_attributes', 'dropdown_list_tag', 'dropdown_list_tag_attributes', 'active_class', 'status', 'created', 'modified'];
        $rows = [
            ['1', 'Main Menu', 'main_menu', 'ul', 'class="nav navbar-nav"', 'li', '', 'ul', 'class="dropdown-menu"', 'li', 'class="dropdown"', 'active', '1', '2016-09-01 18:10:13', '2016-09-06 17:37:44'],
        ];

        foreach ($rows as $row) {
            $data[] = array_combine($headers, $row);
        }
        $table = $this->table('menus');
        $table->insert($data)->save();
    }
}
