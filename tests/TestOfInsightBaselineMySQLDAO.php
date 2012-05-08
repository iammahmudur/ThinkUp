<?php
/**
 *
 * ThinkUp/tests/TestOfInsightBaselineMySQLDAO.php
 *
 * Copyright (c) 2012 Gina Trapani
 *
 * LICENSE:
 *
 * This file is part of ThinkUp (http://thinkupapp.com).
 *
 * ThinkUp is free software: you can redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any
 * later version.
 *
 * ThinkUp is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with ThinkUp.  If not, see
 * <http://www.gnu.org/licenses/>.
 *
 * @license http://www.gnu.org/licenses/gpl.html
 * @copyright 2012 Gina Trapani
 * @author Gina Trapani
 */
require_once dirname(__FILE__).'/init.tests.php';
require_once THINKUP_WEBAPP_PATH.'_lib/extlib/simpletest/autorun.php';
require_once THINKUP_WEBAPP_PATH.'config.inc.php';

class TestOfInsightBaselineMySQLDAO extends ThinkUpUnitTestCase {
    public function setUp() {
        parent::setUp();
        $this->builders = self::buildData();
    }

    protected function buildData() {
        $builders = array();
        $builders[] = FixtureBuilder::build('insight_baselines', array('date'=>'2012-05-01',
        'slug'=>'avg_replies_per_week', 'instance_id'=>1, 'value'=>51));
        return $builders;
    }

    public function tearDown() {
        $this->builders = null;
        parent::tearDown();
    }

    public function testInsertInsightBaseline() {
        $dao = new InsightBaselineMySQLDAO();
        $result = $dao->insertInsightBaseline('avg_replies_per_week', '2012-05-05', 1, 51);
        $this->assertTrue($result);

        $result = $dao->insertInsightBaseline('avg_replies_per_week', '2012-05-05', 1, 50);
        $this->assertTrue($result);
        $result = $dao->getInsightBaseline('avg_replies_per_week', '2012-05-05', 1);
        $this->assertEqual($result->value, 50);
    }

    public function testGetInsightBaseline() {
        $dao = new InsightBaselineMySQLDAO();
        $result = $dao->getInsightBaseline('avg_replies_per_week', '2012-05-01', 1);
        $this->assertIsA($result, 'InsightBaseline');
        $this->assertEqual($result->slug, 'avg_replies_per_week');
        $this->assertEqual($result->date, '2012-05-01');
        $this->assertEqual($result->instance_id, 1);
        $this->assertEqual($result->value, 51);

        $result = $dao->getInsightBaseline('avg_replies_per_week', '2012-05-02', 1);
        $this->assertNull($result);
    }

    public function testUpdateInsightBaseline() {
        $dao = new InsightBaselineMySQLDAO();

        //update existing baseline
        $result = $dao->updateInsightBaseline('avg_replies_per_week', '2012-05-01', 1, 101);
        $this->assertTrue($result);
        //check that value was updated
        $result = $dao->getInsightBaseline('avg_replies_per_week', '2012-05-01', 1);
        $this->assertEqual($result->value, 101);

        //update nonexistent baseline
        $result = $dao->updateInsightBaseline('avg_replies_per_week', '2012-05-10', 1, 101);
        $this->assertFalse($result);
    }
}