extends Node

var areas := {}

#recoge los nodos interactiables y las agrega a la lista
func _ready() -> void:
	for child in get_children():
		if child is Area2D:
			var name_lc = child.name.to_lower()
			areas[name_lc] = false
			
			child.body_entered.connect(_on_any_area_body_entered.bind(name_lc))
			child.body_exited.connect(_on_any_area_body_exited.bind(name_lc))

#el nodo es interactuable
func _on_any_area_body_entered(body: Node2D, area_name: String) -> void:
	if body is Jugador:
		areas[area_name] = true

#ya no es interactuable
func _on_any_area_body_exited(body: Node2D, area_name: String) -> void:
	if body is Jugador:
		areas[area_name] = false

#funcion que al llamarse responde de que si el jugador esta cerca o no
func is_in_area(area_name: String) -> bool:
	area_name = area_name.to_lower()
	return areas.has(area_name) and areas[area_name]
