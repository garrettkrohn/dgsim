import { useQuery } from '@tanstack/react-query';
import { getTournament } from '../../services/tournamentsApi';
import TournamentTemplate from './TournamentTemplate';

export default function TournamentsPlaceholder(props: {
  tournamentId: number;
}) {
  const tournamentId = props.tournamentId;
  const { isLoading, error, data } = useQuery({
    queryKey: [`tournaments/${tournamentId}`],
    queryFn: () => getTournament(tournamentId),
  });
  if (isLoading) return <div>Loading...</div>;

  if (error) return <div>An error has occurred</div>;

  return <TournamentTemplate tournament={data} />;
}
