import React, { useState } from 'react';
// @ts-ignore
import { SliderPicker } from 'react-color';
import Button from '../../util/Button';
import { useMutation } from '@tanstack/react-query';
import { updateAvatarColors, updateUserColors } from '../../services/UserApi';
import { useAuth0 } from '@auth0/auth0-react';
import Loading from '../../util/Loading';
import Error from '../../util/Error';

const ProfilePage = () => {
  const [backgroundColor, setBackgroundColor] = useState('#FF0000');
  const [foregroundColor, setForegroundColor] = useState('#000000');
  const [avatarBackground, setAvatarBackground] = useState('#FF0000');
  const [avatarText, setAvatarText] = useState('#000000');
  const { user } = useAuth0();

  const handleBackgroundChangeComplete = (event: any) => {
    setBackgroundColor(event.hex);
  };

  const handleForegroundChangeComplete = (event: any) => {
    setForegroundColor(event.hex);
  };

  const handleAvatarBackgroundChangeComplete = (event: any) => {
    setAvatarBackground(event.hex);
  };

  const handleAvatarTextChangeComplete = (event: any) => {
    setAvatarText(event.hex);
  };

  const {
    data: colorsData,
    isError: colorsError,
    isLoading: colorsLoading,
    mutate: colorsMutate,
  } = useMutation({
    mutationFn: () =>
      updateUserColors({
        // @ts-ignore
        auth0: user.sub,
        backgroundColor: backgroundColor,
        foregroundColor: foregroundColor,
      }),
    onMutate: () => console.log('mutate'),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => console.log('success'),
  });

  const {
    data: avatarData,
    isError: avatarError,
    isLoading: avatarLoading,
    mutate: avatarMutate,
  } = useMutation({
    mutationFn: () =>
      updateAvatarColors({
        // @ts-ignore
        auth0: user.sub,
        avatarBackgroundColor: avatarBackground,
        avatarTextColor: avatarText,
      }),
    onMutate: () => console.log('mutate'),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => console.log('success'),
  });

  return (
    <div className="flex justify-evenly text-dgsoftwhite">
      <div>
        <div className="w-80 py-4">
          <div className="py-4">
            <div>Select Background Color:</div>
            <SliderPicker
              color={backgroundColor}
              onChangeComplete={handleBackgroundChangeComplete}
            />
          </div>
          <div className="py-4">
            <div>Select Foreground Color:</div>
            <SliderPicker
              color={foregroundColor}
              onChangeComplete={handleForegroundChangeComplete}
            />
          </div>
          <div>Preview:</div>
          <div className="flex flex-row">
            <div
              style={{
                backgroundColor: backgroundColor,
                width: 200,
                height: 200,
              }}
            >
              Background
            </div>
            <div
              style={{
                backgroundColor: foregroundColor,
                width: 200,
                height: 200,
              }}
            >
              Foreground
            </div>
          </div>
          <Button
            label="Save Colors"
            onClick={() => colorsMutate()}
            disable={false}
          />
          {colorsLoading ? <Loading /> : ''}
          {colorsError ? <Error /> : ''}
          {colorsData ? (
            <div className="text-dgsoftwhite">Colors saved</div>
          ) : (
            ''
          )}
        </div>
      </div>
      <div>
        <div className="w-80 py-4">
          <div className="py-4">
            <div>Select Avatar Background Color:</div>
            <SliderPicker
              color={avatarBackground}
              onChangeComplete={handleAvatarBackgroundChangeComplete}
            />
          </div>
          <div className="py-4">
            <div>Select Avatar Text Color:</div>
            <SliderPicker
              color={avatarText}
              onChangeComplete={handleAvatarTextChangeComplete}
            />
          </div>
          <div className="flex flex-col">
            <div>Preview</div>
            <div className="flex justify-center">
              <div
                className="h-24 w-24 rounded-3xl text-center text-7xl"
                style={{ background: avatarBackground, color: avatarText }}
              >
                AB
              </div>
            </div>
          </div>
          <Button
            label="Save Avatar"
            onClick={() => avatarMutate()}
            disable={false}
          />
          {avatarLoading ? <Loading /> : ''}
          {avatarError ? <Error /> : ''}
          {avatarData ? (
            <div className="text-dgsoftwhite">Colors saved</div>
          ) : (
            ''
          )}
        </div>
      </div>
    </div>
  );
};

export default ProfilePage;
