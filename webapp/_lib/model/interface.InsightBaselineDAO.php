<?php
/**
 *
 * ThinkUp/webapp/_lib/model/interface.InsightBaselineDAO.php
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
 * Insight Baseline Data Access Object
 *
 * @license http://www.gnu.org/licenses/gpl.html
 * @copyright 2012 Gina Trapani
 * @author Gina Trapani <ginatrapani[at]gmail[dot]com>
 */
interface InsightBaselineDAO {
    /**
     * Insert insight baseline into storage.
     * @param str $slug
     * @param str $date
     * @param int $instance_id
     * @param int $value
     * @return bool
     */
    public function insertInsightBaseline($slug, $date, $instance_id, $value);
    /**
     * Retrieve insight baseline from storage.
     * @param str $slug
     * @param str $date
     * @param int $instance_id
     * @return InsightBaseline
     */
    public function getInsightBaseline($slug, $date, $instance_id);
    /**
     * Update insight baseline in storage.
     * @param str $slug
     * @param str $date
     * @return bool
     */
    public function updateInsightBaseline($slug, $date, $instance_id, $value);
}