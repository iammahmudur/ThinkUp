<?php
/**
 *
 * ThinkUp/webapp/_lib/model/class.InsightBaselineMySQLDAO.php
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
 * Insight Baseline Data Access Object MySQL Implementation
 *
 * @license http://www.gnu.org/licenses/gpl.html
 * @copyright 2012 Gina Trapani
 * @author Gina Trapani <ginatrapani[at]gmail[dot]com>
 */
class InsightBaselineMySQLDAO  extends PDODAO implements InsightBaselineDAO {

    public function insertInsightBaseline($slug, $date, $instance_id, $value) {
        $baseline = self::getInsightBaseline($slug, $date, $instance_id);
        if ($baseline == null) {
            $q = "INSERT INTO #prefix#insight_baselines SET slug=:slug, date=:date, instance_id=:instance_id, ";
            $q .= "value=:value";
            $vars = array(
            ':slug'=>$slug,
            ':date'=>$date,
            ':instance_id'=>$instance_id,
            ':value'=>$value
            );
            $ps = $this->execute($q, $vars);
            $result = $this->getUpdateCount($ps);
            return ($result > 0);
        } else {
            return self::updateInsightBaseline($slug, $date, $instance_id, $value);
        }
    }

    public function getInsightBaseline($slug, $date, $instance_id) {
        $q = "SELECT date, instance_id, slug, value FROM #prefix#insight_baselines WHERE slug=:slug AND date=:date ";
        $q .= "AND instance_id=:instance_id";
        $vars = array(
            ':slug'=>$slug,
            ':date'=>$date,
            ':instance_id'=>$instance_id
        );
        $ps = $this->execute($q, $vars);
        $row = $this->getDataRowAsArray($ps);
        if ($row) {
            return new InsightBaseline($row);
        } else {
            return null;
        }
    }

    public function updateInsightBaseline($slug, $date, $instance_id, $value) {
        $q = "UPDATE #prefix#insight_baselines SET value=:value ";
        $q .= "WHERE slug=:slug AND date=:date AND instance_id=:instance_id";
        $vars = array(
            ':slug'=>$slug,
            ':date'=>$date,
            ':instance_id'=>$instance_id,
            ':value'=>$value
        );
        $ps = $this->execute($q, $vars);
        $result = $this->getUpdateCount($ps);
        return ($result > 0);
    }
}