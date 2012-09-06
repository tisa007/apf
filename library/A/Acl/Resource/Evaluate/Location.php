<?php
/** 
 *           File:  Location.php
 *           Path:  ./A/Acl/Resource/Evaluate
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-18
 */
namespace A\Acl\Resource\Evaluate;
use A\Acl\Resource;

class Location implements Resource\Evaluate
{
    /**
     * evaluate
     *
     * @param mixed $pattern
     * @param mixed $subject
     * @return bool
     */
    public function evaluate($pattern, $subject)
    {
        $patternPathname = $pattern instanceof Resource ? $pattern->getPathname() : (string)$pattern;
        $subjectPathname = $subject instanceof Resource ? $subject->getPathname() : (string)$subject;

        // if (mb_substr($subjectPathname, 0, mb_strlen($patternPathname)) === $patternPathname)
        if (preg_match('#' . $patternPathname . '#', $subjectPathname))
        {
            if ($pattern instanceof Resource)
            {
                $patternSegments = $pattern->getSegments();
                if (!empty($patternSegments))
                {
                    if (!($subject instanceof Resource))
                    {
                        return false;
                    }

                    $subjectSegments = $subject->getSegments();

                    foreach ($patternSegments as $key => &$val)
                    {
                        if (!isset($subjectSegments[$key]) || $subjectSegments[$key] !== $val)
                        {
                            return false;
                        }
                    }
                }
            }

            return true;
        }

        return false;
    }
}
// End of file : Location.php
