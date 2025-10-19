extends Area2D

func _physics_process(_delta: float) -> void:
	if Estados.escena_divergente2:
		$CollisionShape2D.set_deferred("disabled", true)
	else:
		$CollisionShape2D.set_deferred("disabled", false)
