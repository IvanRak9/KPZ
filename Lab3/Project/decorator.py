class Hero:
    def __init__(self, name):
        self.name = name
        self.inventory = []

    def add_inventory(self, item):
        self.inventory.append(item)

    def show_inventory(self):
        print(f"Inventory of {self.name}:")
        for item in self.inventory:
            print(f"- {item}")


def Wearable(item):
    def decorator(hero):
        hero.add_inventory(f"Wearing {item}")
        return hero
    return decorator


def Weapon(item):
    def decorator(hero):
        hero.add_inventory(f"Holding {item}")
        return hero
    return decorator


def Artifact(item):
    def decorator(hero):
        hero.add_inventory(f"Using {item}")
        return hero
    return decorator


class Warrior(Hero):
    pass

class Mage(Hero):
    pass

class Paladin(Hero):
    pass


def main():
    warrior = Warrior("Warrior")
    warrior = Wearable("Leather Armor")(warrior)
    warrior = Weapon("Sword")(warrior)
    warrior = Artifact("Ring of Strength")(warrior)

    mage = Mage("Mage")
    mage = Wearable("Robe")(mage)
    mage = Weapon("Staff")(mage)
    mage = Artifact("Amulet of Wisdom")(mage)

    paladin = Paladin("Paladin")
    paladin = Wearable("Plate Armor")(paladin)
    paladin = Weapon("Mace")(paladin)
    paladin = Artifact("Holy Shield")(paladin)

    warrior.show_inventory()
    mage.show_inventory()
    paladin.show_inventory()


if __name__ == "__main__":
    main()
