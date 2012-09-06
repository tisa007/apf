<?php
/** 
 *           File:  Widget.php
 *           Path:  ./A/View
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-08
 */
namespace A\View;
use A\View;

interface Widget
{
    /**
     * widget
     *
     * @param A\View $view
     * @param array  $args
     * @return mixed
     */
    public function widget(View $view, array $args = []);
}
// End of file : Widget.php
