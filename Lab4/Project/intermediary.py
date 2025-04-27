class CommandCentre:
    def __init__(self):
        self.runways = []
        self.aircrafts = []

    def add_runway(self, runway):
        self.runways.append(runway)

    def add_aircraft(self, aircraft):
        self.aircrafts.append(aircraft)

    def request_landing(self, aircraft):
        for runway in self.runways:
            if runway.is_free():
                runway.land(aircraft)
                return True
        print("No free runways available for landing.")
        return False

    def request_takeoff(self, aircraft):
        for runway in self.runways:
            if runway.is_free():
                runway.takeoff(aircraft)
                return True
        print("No free runways available for takeoff.")
        return False


class Aircraft:
    def __init__(self, name):
        self.name = name
        self.command_centre = None

    def register_command_centre(self, command_centre):
        self.command_centre = command_centre

    def request_landing(self):
        if self.command_centre:
            self.command_centre.request_landing(self)
        else:
            print("Aircraft cannot request landing without a command centre.")

    def request_takeoff(self):
        if self.command_centre:
            self.command_centre.request_takeoff(self)
        else:
            print("Aircraft cannot request takeoff without a command centre.")


class Runway:
    def __init__(self, id):
        self.id = id
        self.is_busy = False

    def land(self, aircraft):
        print(f"Aircraft {aircraft.name} is landing on Runway {self.id}.")
        self.is_busy = True

    def takeoff(self, aircraft):
        print(f"Aircraft {aircraft.name} is taking off from Runway {self.id}.")
        self.is_busy = False

    def is_free(self):
        return not self.is_busy


def main():
    command_centre = CommandCentre()
    runway1 = Runway(1)
    runway2 = Runway(2)
    command_centre.add_runway(runway1)
    command_centre.add_runway(runway2)

    aircraft1 = Aircraft("A1")
    aircraft2 = Aircraft("A2")
    aircraft1.register_command_centre(command_centre)
    aircraft2.register_command_centre(command_centre)

    aircraft1.request_landing()
    aircraft2.request_landing()

    aircraft1.request_takeoff()
    aircraft2.request_takeoff()


if __name__ == "__main__":
    main()
