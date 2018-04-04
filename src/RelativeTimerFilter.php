<?php

namespace littlesumolabs\timeago;

use Twig\TwigFilter;

/**
 * Class relativeTimerFilter.
 */
class RelativeTimerFilter extends \Twig_Extension
{
    /**
     * RelativeTimerFilter constructor.
     *
     * @param string $timezone
     */
    public function __construct($timezone = 'Europe/Paris')
    {
        date_default_timezone_set($timezone);
        ini_set('date.timezone', $timezone);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter('relativetimer', [$this, 'getRelativeTime']),
        ];
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function getRelativeTime($date): string
    {
        $date_a_comparer = new \DateTime($date);
        $date_actuelle = new \DateTime('now');
        $intervalle = $date_a_comparer->diff($date_actuelle);

        if ($date_a_comparer > $date_actuelle) {
            $prefixe = 'dans ';
        } else {
            $prefixe = 'il y a ';
        }
        $ans = (int) $intervalle->format('%y');
        $mois = (int) $intervalle->format('%m');
        $jours = (int) $intervalle->format('%d');
        $heures = (int) $intervalle->format('%h');
        $minutes = (int) $intervalle->format('%i');
        $secondes = (int) $intervalle->format('%s');

        if (0 !== $ans) {
            $relative_date = $prefixe . $ans . ' an' . (($ans > 1) ? 's' : '');
            if ($mois >= 6) {
                $relative_date .= ' et demi';
            }
        } elseif (0 !== $mois) {
            $relative_date = $prefixe . $mois . ' mois';
            if ($jours >= 15) {
                $relative_date .= ' et demi';
            }
        } elseif (0 !== $jours) {
            $relative_date = $prefixe . $jours . ' jour' . (($jours > 1) ? 's' : '');
        } elseif (0 !== $heures) {
            $relative_date = $prefixe . $heures . ' heure' . (($heures > 1) ? 's' : '');
        } elseif (0 !== $minutes) {
            $relative_date = $prefixe . $minutes . ' minute' . (($minutes > 1) ? 's' : '');
        } elseif (0 !== $secondes) {
            $relative_date = $prefixe . $secondes . ' seconde' . (($minutes > 1) ? 's' : '');
        } else {
            $relative_date = 'Maintenant';
        }

        return $relative_date;
    }
}
