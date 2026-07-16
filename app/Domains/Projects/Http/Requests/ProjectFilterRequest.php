<?php

namespace App\Domains\Projects\Http\Requests;

use App\Domains\Projects\DTOs\ProjectFilterData;
use App\Domains\Projects\Enums\ProjectStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProjectFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorised to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable', new Enum(ProjectStatus::class)],
        ];
    }

    /**
     * Map the validated request data to a DTO.
     */
    public function toDto(): ProjectFilterData
    {
        $status = $this->validated('status');

        return new ProjectFilterData(
            status: $status ? ProjectStatus::tryFrom($status) : null,
        );
    }
}
