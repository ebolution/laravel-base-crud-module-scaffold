<?php
/**
 * @category  Ebolution
 * @package   ebolution/bigcommerce-app-adapter
 * @author    Carlos Cid <carlos.cid@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   MIT
 */

namespace Ebolution\BaseCrudModuleScaffold\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

final class BaseCrudModuleScaffoldEntity extends Model
{
    protected $table = '@table_name';

    // TODO: List the fields on your entity
    protected $fillable = [
        'field1',
        'field2',
    ];
}
