export interface TournamentResource {
  tournamentId: number;
  tournamentName: string;
  courseResponseDto: {
    courseId: number;
    name: string;
    coursePar: number;
    holes: object[];
  };
  season: number;
  playerTournament: {
    playerTournamentId: number;
    tourPoints: number;
    totalScore: number;
    player_tournament_id: number;
    luckScore: number;
    place: number;
    playerResponseDto: {
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
    };
    rounds: {
      roundId: number;
      roundTotal: number;
      luckScore: number;
      roundType: string;
      round_id: number;
      holeresults: {
        score: number;
        c1Putts: number;
        c2Putts: number;
        parked: boolean;
        c1inRegulation: boolean;
        c2inRegulation: boolean;
        scramble: boolean;
        luck: number;
      }[];
    }[];
  }[];
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
