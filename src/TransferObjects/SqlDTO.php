<?php

declare(strict_types=1);

namespace App\TransferObjects;


class SqlDTO
{
//    TODO add functionality to add relation at hoc
    public const REPLACE_TYPE = 'REPLACE INTO';
    public const INSERT_TYPE = 'INSERT INTO';
    public const UPDATE_TYPE = 'UPDATE';
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $dbSchema;
    /**
     * @var array
     */
    private $fieldValues;
    /**
     * @var \App\TransferObjects\SqlDTO[]
     */
    private $related;
    /**
     * @var string|null
     */
    private $relatedField;

    public function __construct(
        string $type,
        string $dbSchema,
        array $fieldValues,
        ?array $related,
        ?string $relatedField
    ) {
        $this->type = $type;
        $this->dbSchema = $dbSchema;
        $this->fieldValues = $this->normalizeWhitespaces($fieldValues);
        $this->related = $related;
        if ($related) {
            $this->related = $this->normalizeWhitespaces($related);
        }
        $this->relatedField = $relatedField;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDbSchema(): string
    {
        return $this->dbSchema;
    }

    /**
     * @return array
     */
    public function getFieldValues(): array
    {
        return $this->fieldValues;
    }

    /**
     * @return \App\TransferObjects\SqlDTO[]
     */
    public function getRelated(): ?array
    {
        return $this->related;
    }

    /**
     * @return string|null
     */
    public function getRelatedField(): ?string
    {
        return $this->relatedField;
    }

    public function getSql()
    {
        $fields = array_keys($this->fieldValues);
        $fieldsHeader = '`';
        $fieldsParameters = '';
        foreach ($fields as $key => $field) {
            if ($key === array_key_last($fields)) {
                $fieldsHeader .= $field.'`';
                $fieldsParameters .= ':'.$field;
                continue;
            }
            $fieldsHeader .= $field.'`, `';
            $fieldsParameters .= ':'.$field.', ';
        }
        $sql = "{$this->type} {$this->dbSchema}
({$fieldsHeader})
VALUES
(
{$fieldsParameters}
);";

        return $sql;
    }

    /**
     * @param string $fieldName
     * @param string|int       $fieldValue
     */
    public function addField(string $fieldName, $fieldValue)
    {
        $this->fieldValues[$fieldName] = $fieldValue;
    }

    private function normalizeWhitespaces(array $fields)
    {
        $normalized = [];
        foreach ($fields as $key => $field) {
            $normalized[$key] = trim(preg_replace('/(?:\s{2,}+|[^\S ])/', ' ', $field));
        }
        return $normalized;
    }
}
