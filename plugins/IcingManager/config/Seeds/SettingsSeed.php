<?php
use Phinx\Seed\AbstractSeed;

/**
 * Settings seed.
 */
class SettingsSeed extends AbstractSeed
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

        $headers = ['id', 'key', 'val', 'title', 'help', 'input_type', 'input_params', 'order'];
        $rows = [
            ['1', 'Site.Title', 'IcingCMS', 'Site Title', 'This is the Site Title', 'text', 'class=\"form-control\"', '1'],
            ['2', 'Site.Tagline', 'A CakePHP 3 Content Management System', 'Tagline', 'Site Tagline', 'text', 'class=\"form-control\"', '2'],
            ['3', 'Theme.Background', '#fff', 'Theme Background', 'This will change the site background', 'text', 'class=\"form-control\"', '1'],
            ['4', 'User.allow_add', '0', 'Allow users to register', '', 'checkbox', '', '1'],
            ['5', 'User.login_attempt', '5', 'Number of login attemptes', '', 'number', 'class=\"form-control\"', '2'],
            ['6', 'User.noreply_email', 'noreply@icingcms.com', 'No reply email used by the site.', '', 'text', 'class=\"form-control\"', '3'],
        ];

        foreach ($rows as $row) {
            $data[] = array_combine($headers, $row);
        }
        $table = $this->table('settings');
        $table->insert($data)->save();
    }
}
