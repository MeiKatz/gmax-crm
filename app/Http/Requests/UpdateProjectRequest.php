<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      'name' => [
        'nullable',
        'string',
      ],
      'client' => [
        'nullable',
        'exists:clients,id',
      ],
      'status' => [
        'nullable',
        'integer',
      ],
      'description' => [
        'nullable',
        'string',
      ],
      'starts_at' => [
        'nullable',
        'date_format:Y-m-d',
      ],
      'deadline_at' => [
        'nullable',
        'date_format:Y-m-d',
      ],
    ];
  }

  public function validated() {
    $data = parent::validated();

    if ( isset( $data['client'] ) ) {
      $data['client_id'] = $data['client'];
      unset( $data['client'] );
    }

    return $data;
  }
}
