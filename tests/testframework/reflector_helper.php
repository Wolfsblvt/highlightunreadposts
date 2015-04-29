<?php
/**
 *
 * Highlight Unread Posts
 *
 * @copyright (c) 2015 Wolfsblvt ( www.pinkes-forum.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Clemens Husung (Wolfsblvt)
 */

namespace wolfsblvt\highlightunreadposts\tests\testframework;

/**
 * A class for easy use of reflection inside tests
 */
class reflector_helper
{
	/**
	 * Gets a ReflectionMethod for a class method.
	 *
	 * @param object $obj The object to reflect
	 * @param string $name The method name to reflect
	 *
	 * @return \ReflectionMethod
	 */
	public function getMethod($obj, $method)
	{
		$reflection = new \ReflectionObject($obj);
		$method = $reflection->getMethod($method);
		$method->setAccessible(true);

		return $method;
	}

	/**
	 * Gets a ReflectionProperty for a class's property.
	 *
	 * @param object $obj The object to reflect
	 * @param string $property The property name
	 *
	 * @return \ReflectionProperty
	 */
	public function getProperty($obj, $property)
	{
		$reflection = new \ReflectionObject($obj);
		$property = $reflection->getProperty($property);
		$property->setAccessible(true);

		return $property->getValue($obj);
	}

	/**
	 * Set property value
	 * Sets (changes) the property's value.
	 *
	 * @param object $obj The object to reflect
	 * @param string $property The property name
	 * @param mixed $value The new value
	 *
	 * @return void
	 */
	public function setProperty($obj, $property, $value)
	{
		$reflection = new \ReflectionObject($obj);
		$property = $reflection->getProperty($property);
		$property->setAccessible(true);

		$property->setValue($obj, $value);
	}
}
