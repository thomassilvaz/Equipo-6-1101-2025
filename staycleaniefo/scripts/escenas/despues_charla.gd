extends CollisionShape2D

#activa o desactiva la escena segun si se tomo la decision
func _ready() -> void:
	if Estados.charla_con_valeria:
		set_deferred("disabled", false)
	else:
		set_deferred("disabled", true)
