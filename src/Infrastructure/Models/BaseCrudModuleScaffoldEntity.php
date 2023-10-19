<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModuleScaffold
 * @author    @module.author.name @module.author.email
 * @copyright @module.copyright
 * @license   @module.license
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
