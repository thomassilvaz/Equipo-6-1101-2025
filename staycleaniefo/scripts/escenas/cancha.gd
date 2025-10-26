extends CollisionShape2D

#activa o desactiva la escena segun si se tomo la decision
func _ready():
	if Estados.decision3_tomada and Estados.decision_2 == "mala":
		set_deferred("disabled", false)
	else:
		set_deferred("disabled", true)
