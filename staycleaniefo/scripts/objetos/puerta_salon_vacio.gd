extends Area2D

@export var colision_a_detectar: NodePath
var condicion: String
var hecha: bool

#asigna variables
func _ready():
	var target_node = get_node(colision_a_detectar)
	condicion = target_node.condicion_a_detectar
	hecha = target_node.condicion_hecha

#activa la puerta si se cumple la condicion, en tiempo real
func _on_body_entered(body: Node2D) -> void:
	if body is Jugador:
		var target_node = get_node(colision_a_detectar)
		
		if Estados.get(condicion) != null:
			hecha = Estados.get(condicion)
		if !hecha:
			target_node.set_deferred("disabled", false)
			print("Puede pasar")
		else:
			target_node.set_deferred("disabled", true)
			print("No puede pasar")
