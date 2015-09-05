<?php
/**
 * PHT
 *
 * @author Telesphore
 * @link https://github.com/jetwitaussi/PHT
 * @version 3.0
 * @license "THE BEER-WARE LICENSE" (Revision 42):
 *          Telesphore wrote this file.  As long as you retain this notice you
 *          can do whatever you want with this stuff. If we meet some day, and you think
 *          this stuff is worth it, you can buy me a beer in return.
 */

namespace PHT\Wrapper;

use PHT\Xml;
use PHT\Config;
use PHT\Network;

class Match
{
    /**
     * @param integer $id
     * @param boolean $events
     * @return \PHT\Xml\Match
     */
    public static function senior($id, $events = true)
    {
        return self::match(Config\Config::MATCH_SENIOR, $id, $events);
    }

    /**
     * @param integer $id
     * @param boolean $events
     * @return \PHT\Xml\Match
     */
    public static function youth($id, $events = true)
    {
        return self::match(Config\Config::MATCH_YOUTH, $id, $events);
    }

    /**
     * @param integer $id
     * @param boolean $events
     * @return \PHT\Xml\Match
     */
    public static function tournament($id, $events = true)
    {
        return self::match(Config\Config::MATCH_TOURNAMENT, $id, $events);
    }

    /**
     * @param string $type
     * @param integer $id
     * @param boolean $events
     * @return \PHT\Xml\Match
     */
    private static function match($type, $id, $events)
    {
        $params = array('file' => 'matchdetails', 'version' => Config\Version::MATCHDETAILS, 'sourceSystem' => $type, 'matchID' => $id);
        if ($events === true) {
            $params['matchEvents'] = 'true';
        }
        $url = Network\Request::buildUrl($params);
        return new Xml\Match(Network\Request::fetchUrl($url));
    }

    /**
     * @param integer $matchId
     * @param integer $teamId
     * @return \PHT\Xml\Match\Lineup
     */
    public static function seniorlineup($matchId = null, $teamId = null)
    {
        return self::lineup(Config\Config::MATCH_SENIOR, $matchId, $teamId);
    }

    /**
     * @param integer $matchId
     * @param integer $teamId
     * @return \PHT\Xml\Match\Lineup
     */
    public static function youthlineup($matchId = null, $teamId = null)
    {
        return self::lineup(Config\Config::MATCH_YOUTH, $matchId, $teamId);
    }

    /**
     * @param integer $matchId
     * @param integer $teamId
     * @return \PHT\Xml\Match\Lineup
     */
    public static function tournamentlineup($matchId, $teamId = null)
    {
        return self::lineup(Config\Config::MATCH_TOURNAMENT, $matchId, $teamId);
    }

    /**
     * @param integer $matchId
     * @param integer $teamId
     * @return \PHT\Xml\Match\Lineup
     */
    private static function lineup($type, $matchId = null, $teamId = null)
    {
        $params = array('file' => 'matchlineup', 'version' => Config\Version::MATCHLINEUP, 'sourceSystem' => $type);
        if ($matchId !== null) {
            $params['matchID'] = $matchId;
        }
        if ($teamId !== null) {
            $params['teamID'] = $teamId;
        }
        $url = Network\Request::buildUrl($params);
        return new Xml\Match\Lineup(Network\Request::fetchUrl($url));
    }

    /**
     * @param integer $matchId
     * @param integer $teamId
     * @return \PHT\Xml\Match\Orders
     */
    public static function seniororders($matchId, $teamId = null)
    {
        return self::orders(Config\Config::MATCH_SENIOR, $matchId, $teamId);
    }

    /**
     * @param integer $matchId
     * @param integer $teamId
     * @return \PHT\Xml\Match\Orders
     */
    public static function youthorders($matchId, $teamId = null)
    {
        return self::orders(Config\Config::MATCH_YOUTH, $matchId, $teamId);
    }

    /**
     * @param integer $matchId
     * @param integer $teamId
     * @return \PHT\Xml\Match\Orders
     */
    public static function tournamentorders($matchId, $teamId = null)
    {
        return self::orders(Config\Config::MATCH_TOURNAMENT, $matchId, $teamId);
    }

    /**
     * @param integer $matchId
     * @param integer $teamId
     * @return \PHT\Xml\Match\Orders
     */
    private static function orders($type, $matchId, $teamId = null)
    {
        $params = array('file' => 'matchorders', 'version' => Config\Version::MATCHORDERS, 'matchID' => $matchId, 'sourceSystem' => $type);
        if ($teamId !== null) {
            $params['teamId'] = $teamId;
        }
        $url = Network\Request::buildUrl($params);
        return new Xml\Match\Orders(Network\Request::fetchUrl($url));
    }
}