import React, { useEffect, useState } from 'react';
import { SliderPicker } from 'react-color';
import Button from '../../util/Button';
import { useMutation } from '@tanstack/react-query';
import { updateAvatarColors, updateUserColors } from '../../services/UserApi';
import { useAuth0 } from '@auth0/auth0-react';
import Loading from '../../util/Loading';
import Error from '../../util/Error';
import { customColors, loggedInUser } from '../../jotai/Atoms';
import { useAtom } from 'jotai/index';
import colors from 'tailwindcss/colors';

const ProfilePage = () => {
  const [backgroundColor, setBackgroundColor] = useState('#FF0000');
  const [foregroundColor, setForegroundColor] = useState('#000000');
  const [avatarBackground, setAvatarBackground] = useState('#FF0000');
  const [avatarText, setAvatarText] = useState('#000000');
  const { user: authUser } = useAuth0();
  const [user, setUser] = useAtom(loggedInUser);
  const [displayCustomColors, setDisplayCustomColors] = useAtom(customColors);

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

  const toggleSwitch = () => {
    setDisplayCustomColors(!displayCustomColors);
    console.log(displayCustomColors);
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
        auth0: authUser.sub,
        backgroundColor: backgroundColor,
        foregroundColor: foregroundColor,
      }),
    onMutate: () => console.log('mutate'),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => {
      console.log('colors received');
    },
  });

  useEffect(() => {
    if (colorsData) {
      setUser(colorsData);
    }
  }, [colorsData]);

  const {
    data: avatarData,
    isError: avatarError,
    isLoading: avatarLoading,
    mutate: avatarMutate,
  } = useMutation({
    mutationFn: () =>
      updateAvatarColors({
        // @ts-ignore
        auth0: authUser.sub,
        avatarBackgroundColor: avatarBackground,
        avatarTextColor: avatarText,
      }),
    onMutate: () => console.log('mutate'),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => {
      console.log('avatar received');
    },
  });

  useEffect(() => {
    if (avatarData) {
      setUser(avatarData);
    }
  }, [avatarData]);

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
      <div className="flex justify-center">
        <input
          className="checked:bg-primary checked:after:bg-primary checked:focus:border-primary checked:focus:bg-primary dark:checked:bg-primary dark:checked:after:bg-primary mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
          type="checkbox"
          role="switch"
          id="flexSwitchCheckDefault"
          checked={displayCustomColors}
          onClick={toggleSwitch}
        />
        <label
          className="inline-block pl-[0.15rem] hover:cursor-pointer"
          htmlFor="flexSwitchCheckDefault"
        >
          Custom Colors
        </label>
      </div>
    </div>
  );
};

export default ProfilePage;
