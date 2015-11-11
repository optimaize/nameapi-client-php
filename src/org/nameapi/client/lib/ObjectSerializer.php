<?php

namespace org\nameapi\client\lib;

/**
 * ObjectSerializer for converting to and from JSON.
 *
 * Based on auto-generated code from https://github.com/swagger-api/swagger-codegen
 *
 * @category Class
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 */
class ObjectSerializer
{

    /**
     * Build a JSON POST object
     *
     * @param mixed $data the data to serialize
     *
     * @return string serialized form of $data
     */
    public function sanitizeForSerialization($data)
    {
        if (is_scalar($data) || null === $data) {
            $sanitized = $data;
        } else if (is_array($data)) {
            foreach ($data as $property => $value) {
                $data[$property] = $this->sanitizeForSerialization($value);
            }
            $sanitized = $data;
        } else if (is_object($data)) {
            $values = array();
            foreach (array_keys($data::$swaggerTypes) as $property) {
                $getter = $data::$getters[$property];
                if ($data->$getter() !== null) {
                    $values[$data::$attributeMap[$property]] = $this->sanitizeForSerialization($data->$getter());
                }
            }
            $sanitized = $values;
        } else {
            $sanitized = (string)$data;
        }

        return $sanitized;
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the path, by url-encoding.
     *
     * @param string $value a string which will be part of the path
     *
     * @return string the serialized object
     */
    public function toPathValue($value)
    {
        return rawurlencode($this->toString($value));
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the query, by imploding comma-separated if it's an object.
     * If it's a string, pass through unchanged. It will be url-encoded
     * later.
     *
     * @param object $object an object to be serialized to a string
     *
     * @return string the serialized object
     */
    public function toQueryValue($object)
    {
        if (is_array($object)) {
            return implode(',', $object);
        } else {
            return $this->toString($object);
        }
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the header. If it's a string, pass through unchanged.
     *
     * @param string $value a string which will be part of the header
     *
     * @return string the header string
     */
    public function toHeaderValue($value)
    {
        return $this->toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the http body (form parameter). If it's a string, pass through unchanged
     *
     * @param string $value the value of the form parameter
     *
     * @return string the form string
     */
    public function toFormValue($value)
    {
        if ($value instanceof SplFileObject) {
            throw new \Exception("File handling is not supported!");
        } else {
            return $this->toString($value);
        }
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the parameter. If it's a string, pass through unchanged.
     *
     * @param string $value the value of the parameter
     *
     * @return string the header string
     */
    public function toString($value)
    {
        return $value;
    }

    /**
     * Deserialize a JSON string into an object
     *
     * @param mixed  $data       object or primitive to be deserialized
     * @param string $class      class name is passed as a string
     *
     * @return object an instance of $class
     */
    public function deserialize($data, $class)
    {
        if (null === $data) {
            $deserialized = null;
        } elseif (substr($class, 0, 4) === 'map[') { // for associative array e.g. map[string,int]
            $inner = substr($class, 4, -1);
            $deserialized = array();
            if (strrpos($inner, ",") !== false) {
                $subClass_array = explode(',', $inner, 2);
                $subClass = $subClass_array[1];
                foreach ($data as $key => $value) {
                    $deserialized[$key] = $this->deserialize($value, $subClass);
                }
            }
        } elseif (strcasecmp(substr($class, -2), '[]') == 0) {
            $subClass = substr($class, 0, -2);
            $values = array();
            foreach ($data as $key => $value) {
                $values[] = $this->deserialize($value, $subClass);
            }
            $deserialized = $values;
        } elseif (in_array($class, array('void', 'bool', 'string', 'double', 'byte', 'mixed', 'integer', 'float', 'int', 'DateTime', 'number', 'boolean', 'object'))) {
            settype($data, $class);
            $deserialized = $data;
        } elseif ($class === '\SplFileObject') {
            throw new \Exception("File handling is not supported!");
        } else {
            $instance = new $class();
            foreach ($instance::$swaggerTypes as $property => $type) {
                $propertySetter = $instance::$setters[$property];
     
                if (!isset($propertySetter) || !isset($data->{$instance::$attributeMap[$property]})) {
                    continue;
                }
     
                $propertyValue = $data->{$instance::$attributeMap[$property]};
                if (isset($propertyValue)) {
                    $instance->$propertySetter($this->deserialize($propertyValue, $type));
                }
            }
            $deserialized = $instance;
        }
     
        return $deserialized;
    }
}
