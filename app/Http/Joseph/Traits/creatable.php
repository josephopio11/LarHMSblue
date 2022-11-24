<?php

namespace App\Http\Joseph\Traits;

trait updatableAndCreatable {

        public static function bootCreatable() {

            // Create
            if(auth()->check()) {
                static::creating(function($model) {
                    $model->created_by_id = auth()->user()->id;
                });
            }

            // Update
            if(auth()->check()) {
                static::updating(function($model) {
                    $model->updated_by_id = auth()->user()->id;
                });
            }
        }

}
