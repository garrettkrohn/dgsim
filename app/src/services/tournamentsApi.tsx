export interface TournamentResource {
  tournamentId: number;
  tournamentName: string;
  courseResponseDto: courseResource;
  season: number;
  playerTournament: playerTournamentResource[];
}

export interface playerTournamentResource {
  playerTournamentId: number;
  tourPoints: number;
  totalScore: number;
  player_tournament_id: number;
  luckScore: number;
  place: number;
  playerResponseDto: playerResource;
  rounds: {
    roundId: number;
    roundTotal: number;
    luckScore: number;
    roundType: string;
    holeResults: holeResultResource[];
  }[];
}

export interface holeResultResource {
  score: number;
  c1Putts: number;
  c2Putts: number;
  parked: boolean;
  c1inRegulation: boolean;
  c2inRegulation: boolean;
  scramble: boolean;
  luck: number;
}

export interface playerResource {
  player_id: number;
  first_name: string;
  last_name: string;
  putt_skill: number;
  throw_power_skill: number;
  throw_accuracy_skill: number;
  scramble_skill: number;
  start_season: number;
  is_active: boolean;
  banked_skill_points: number;
  archetype: object;
}

export interface courseResource {
  courseId: number;
  name: string;
  coursePar: number;
  holes: holesResource[];
}

export interface holesResource {
  c1Rate: number;
  c2Rate: number;
  courseId: number;
  holeId: number;
  par: number;
  parkedRate: number;
  scrambleRate: number;
}

export async function getTournament(
  tournamentId: number,
): Promise<TournamentResource> {
  return await fetch(`http://localhost:8000/api/tournaments/${tournamentId}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: TournamentResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
