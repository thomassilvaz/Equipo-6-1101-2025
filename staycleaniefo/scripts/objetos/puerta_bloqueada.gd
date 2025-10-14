extends CollisionShape2D

@export var condicion_a_detectar: String
var condicion_hecha: bool

func _ready() -> void:
	if Estados.get(condicion_a_detectar) != null:
		condicion_hecha = Estados.get(condicion_a_detectar)
	if !condicion_hecha:
		set_deferred("disabled", false)
		print("Puede pasar")
	else:
		set_deferred("disabled", true)
		print("No puede pasar")
