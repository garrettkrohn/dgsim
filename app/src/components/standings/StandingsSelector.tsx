import React, { useEffect, useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getSeasonLeaderboards } from '../../services/standingsApi';
import Loading from '../../util/Loading';
import StandingsTemplate from './StandingsTemplate';

const StandingsSelector = () => {
  const [seasonNumber, setSeasonNumber] = useState(1);

  const {
    isLoading: standingsAreLoading,
    error: standingsError,
    data: standingsData,
    refetch,
  } = useQuery({
    queryKey: [`standings/season`],
    queryFn: () => getSeasonLeaderboards(seasonNumber),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (standingsAreLoading) {
    return <Loading />;
  }

  if (standingsError) {
    return <div>ope, something went wrong</div>;
  }

  console.log(standingsData);

  function compare(a: any, b: any) {
    if (a.totalScore < b.totalScore) {
      return -1;
    } else if (a.totalScore > b.totalScore) {
      return 1;
    }
    return 0;
  }

  if (standingsData) {
    const standings = standingsData.sort(compare);
    return <StandingsTemplate standings={standings} />;
  }
};

export default StandingsSelector;
