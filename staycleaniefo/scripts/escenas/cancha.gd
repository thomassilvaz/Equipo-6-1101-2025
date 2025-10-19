extends CollisionShape2D

func _ready():
	if Estados.decision3_tomada and Estados.decision_2 == "mala":
		set_deferred("disabled", false)
	else:
		set_deferred("disabled", true)
